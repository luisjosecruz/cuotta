const tab1 = document.querySelector('.tab1');
const tab2 = document.querySelector('.tab2');
const panel1 = document.querySelector('.panel1');
const panel2 = document.querySelector('.panel2');

const slidePayCard = () => {
    $(".pay").addClass("pay-active");
    $(".panel2").fadeOut("fast");
    $(".btn-tab").removeClass("active");
    tab1.classList.add("active");
    panel1.style.display = "block";
    panel1.classList.remove("active");
    setTimeout(() => panel1.classList.add("active"), 100);
    $(".line").show();
    $(".line").removeClass("line-right");
    $(".line").addClass("line-left");
    $(".xtab").css("opacity", "1");
};

const slidePayBtc = () => {
    $(".pay").addClass("pay-active");
    $(".panel1").fadeOut("fast");
    panel2.style.display = "block";
    panel2.classList.remove("active");
    $(".btn-tab").removeClass("active");
    tab2.classList.add("active");
    setTimeout(() => panel2.classList.add("active"), 100);
    $(".line").show();
    $(".line").removeClass("line-left");
    $(".line").addClass("line-right");
    $(".xtab").css("opacity", "1");
};

tab1.addEventListener('click', slidePayCard);
tab2.addEventListener('click', slidePayBtc);

$(".xtab").click(function() {
    $(this).css("opacity", "0");
    $(".pay").removeClass("pay-active");
    $(".btn-tab").removeClass("active");
    $(".tab-content").fadeOut();
    $(".line").fadeOut();
});

if (screen.width >= 1024) {
    $(".pay").addClass("pay-active");
    panel1.style.display = "block";
    panel1.classList.add("active");
    tab1.classList.add("active");
    $(".line").show();
    $(".line").addClass("line-left");
    $(".xtab").css("display", "none");
}

