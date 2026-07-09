// ===============================
// DASHBOARD - ELIANA DANTAS PERSONAL
// ===============================

document.addEventListener("DOMContentLoaded", () => {

    // -------------------------
    // Animação dos Cards
    // -------------------------
    const cards = document.querySelectorAll(".card");

    cards.forEach((card, index) => {

        card.style.opacity = "0";
        card.style.transform = "translateY(30px)";

        setTimeout(() => {
            card.style.transition = ".6s";
            card.style.opacity = "1";
            card.style.transform = "translateY(0)";
        }, index * 200);

    });

    // -------------------------
    // Gráfico
    // -------------------------

    const grafico = document.getElementById("grafico");

    if(grafico){

        new Chart(grafico, {

            type: "line",

            data: {

                labels: [
                    "Jan",
                    "Fev",
                    "Mar",
                    "Abr",
                    "Mai",
                    "Jun"
                ],

                datasets: [{

                    label: "Novos alunos",

                    data: [
                        4,
                        8,
                        12,
                        15,
                        20,
                        25
                    ],

                    borderWidth:3,

                    tension:.4,

                    fill:true

                }]

            },

            options: {

                responsive:true,

                plugins:{
                    legend:{
                        display:true
                    }
                }

            }

        });

    }

});

// ==========================
// Notificação
// ==========================

function mostrarNotificacao(texto){

    alert(texto);

}

// Exemplo

setTimeout(()=>{

    mostrarNotificacao("Você possui 3 agendamentos para hoje.");

},1500);
// =============================
// Menu recolhível
// =============================

const botao = document.getElementById("menu-btn");

const sidebar = document.querySelector(".sidebar");

const content = document.querySelector(".content");

if(botao){

    botao.addEventListener("click",()=>{

        sidebar.classList.toggle("fechada");

        content.classList.toggle("expandido");

    });

}