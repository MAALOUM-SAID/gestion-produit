$(function(){
    $('.fadein img:gt(0)').hide();
    setInterval(function(){
        $('.fadein :first-child')
        .fadeOut(1500)
        .next('img')
        .fadeIn(1000)
        .end()
        .appendTo('.fadein');
    }, 2000);
});
const setTheme = ()=>{
    if (document.documentElement.className==="dark") {
        document .documentElement.className = "light";
    }else{
        document .documentElement.className = "dark";
        
    }
}

function confirmer(event) {
    let ok=confirm("Voulez Vous Supprimer ce Produit");
    if (!ok) {
    event.preventDefault();
    }
}