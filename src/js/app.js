const mobileMenuBtn =document.querySelector('#mobile-menu');
const cerrarMenuBtn =document.querySelector('#cerrar-menu');
const sidebar = document.querySelector('.sidebar');

if(mobileMenuBtn){
    
    mobileMenuBtn.addEventListener('click', function(){
        sidebar.classList.add('mostrar');
    });
}

if(cerrarMenuBtn){
    cerrarMenuBtn.addEventListener('click', function(){
//con esto ya no se selecciona el menu mobile despues de ocultar, porque se superponia
        sidebar.classList.add('ocultar');

        setTimeout(() => {
            sidebar.classList.remove('mostrar');
            sidebar.classList.remove('ocultar');
        }, 1000);
    });
}


//elimina la clase de mostrar en un tamaño de tablet y mayores

const anchoPantalla = document.body.clientWidth;

window.addEventListener('resize', function(){
    const anchoPantalla = document.body.clientWidth;

    if (anchoPantalla >=768) {
        sidebar.classList.remove('mostrar');
    }
})