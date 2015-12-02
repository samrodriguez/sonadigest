
function validarUsuario(){
$('.rolUsuario > input').
        attr('data-bvalidator', 'required,required');

$('.nombreUsuario').
        attr('data-bvalidator', 'required,required');

$('.firstPassword').
        attr('data-bvalidator', 'required,required');

$('.persona').
        attr('data-bvalidator', 'required,required');

$('.secondPassword').
        attr('data-bvalidator', 'required,required');
	
 
    //Opciones del validador
    var optionsRed = { 
        classNamePrefix: 'bvalidator_bootstraprt_', 
        lang: 'es'
    };
 
    //Validar el formulario
    $('form').bValidator(optionsRed);
	
 }	
	