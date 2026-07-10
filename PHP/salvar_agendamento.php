<?php
require 'conectar.php';

if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
}

function enviarNotificacaoAgendamento($alunoNome, $data, $horario, $observacao)
{
    $destinatario = getenv('EMAIL_NOTIFICACAO') ?: 'seuemail@gmail.com';
    $remetente = getenv('SMTP_FROM') ?: 'seuemail@gmail.com';
    $mensagem = "Olá!\n\nFoi realizado um novo agendamento.\n\nAluno: $alunoNome\nData: $data\nHorário: $horario\nObservação: $observacao\n";

    if (class_exists('PHPMailer\\PHPMailer\\PHPMailer')) {
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = getenv('SMTP_USER') ?: 'seuemail@gmail.com';
            $mail->Password = getenv('SMTP_PASS') ?: 'sua-senha-de-app';
            $mail->SMTPSecure = getenv('SMTP_ENCRYPTION') ?: 'tls';
            $mail->Port = (int)(getenv('SMTP_PORT') ?: 587);
            $mail->CharSet = 'UTF-8';

            $mail->setFrom($remetente, 'Sistema Eliana Personal');
            $mail->addAddress($destinatario);
            $mail->Subject = 'Novo agendamento realizado';
            $mail->Body = $mensagem;
            $mail->AltBody = $mensagem;

            return $mail->send();
        } catch (Exception $e) {
            return false;
        }
    }

    $assunto = 'Novo agendamento realizado';
    $headers = "From: $remetente\r\n";
    $headers .= "Reply-To: $remetente\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    return @mail($destinatario, $assunto, $mensagem, $headers);
}

function enviarMensagemWhatsApp($alunoNome, $data, $horario, $observacao)
{
    $numeroDestino = getenv('WHATSAPP_TO') ?: '5584986208694';
    $mensagem = "Novo agendamento: $alunoNome em $data às $horario. Observação: $observacao";

    $url = getenv('WHATSAPP_WEBHOOK') ?: 'https://postman-echo.com/post';
    $dados = http_build_query([
        'to' => $numeroDestino,
        'message' => $mensagem,
    ]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $resposta = curl_exec($ch);
    curl_close($ch);

    $texto = "[whatsapp] para $numeroDestino: $mensagem\n";
    file_put_contents(__DIR__ . '/whatsapp_log.txt', $texto, FILE_APPEND);

    return $resposta !== false;
}

$alunoNome = trim($_POST['aluno_nome'] ?? '');
$data = trim($_POST['data'] ?? '');
$horario = trim($_POST['horario'] ?? '');
$observacao = trim($_POST['observacao'] ?? '');

if ($alunoNome === '' || $data === '' || $horario === '') {
    die('Preencha o nome, a data e o horário.');
}

$sql = "INSERT INTO agendamentos (aluno_nome, data, horario, observacao) VALUES ('$alunoNome', '$data', '$horario', '$observacao')";
if ($conn->query($sql)) {
    enviarNotificacaoAgendamento($alunoNome, $data, $horario, $observacao);
    enviarMensagemWhatsApp($alunoNome, $data, $horario, $observacao);
    header('Location: ../index/agenda.php');
    exit();
}

echo 'Erro ao salvar agendamento: ' . $conn->error;
?>