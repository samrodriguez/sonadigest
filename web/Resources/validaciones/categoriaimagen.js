
 function validarCategoriaImagen(){
$('.nombresCategoriaImagen').
  attr('data-bvalidator', 'required,required');
 
  
$('.foto').
  attr('data-bvalidator', 'extension[jpg:png],required');
$('.foto').
  attr('data-bvalidator-msg', 'Seleccione una imagen .jpg o .png');    
  
 
    //Opciones del validador
    var optionsRed = { 
        classNamePrefix: 'bvalidator_bootstraprt_', 
        lang: 'es'
    };
 
    //Validar el formulario
    $('form').bValidator(optionsRed);
    //$('.foto').bValidator().css('margin-top','30px');
    //$('.fotoEmpleado').bValidator().css('position','absolute');
    //$('.fotoEmpleado').bValidator().css('width','50px');
    //$('.btn-file').css('width','200px');
	
 }	
 
 
 function validarCategoriaImagenEdit(){

    
    $('.foto').
        attr('data-bvalidator-msg', 'Seleccione una imagen .jpg o .png');    
  
 
    //Opciones del validador
    var optionsRed = { 
        classNamePrefix: 'bvalidator_bootstraprt_', 
        lang: 'es'
    };
 
    //Validar el formulario
    $('form').bValidator(optionsRed);
    //$('.foto').bValidator().css('margin-top','30px');
    //$('.fotoEmpleado').bValidator().css('position','absolute');
    //$('.fotoEmpleado').bValidator().css('width','50px');
    //$('.btn-file').css('width','200px');
	
 }	
	
