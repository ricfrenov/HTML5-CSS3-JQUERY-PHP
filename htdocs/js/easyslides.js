$(document).ready(function(){

    // Set up our options for the slideshow...
    var myOptions = {
        noImages: 3,
        path: "images/slide/",  // Relative path with trailing slash.
        captions: {  
    
          1:'<b>Conheça Nossas Unidades e Infraestrutura >></p> <div style="font-size:14px;margin-top:5px;"><b>Estude na melhor Instituição de Ensino em Camaçari.</p></div>',
                     
            2:'<b>This is Easy Slides - Possibly the easiest to use jQuery plugin for making slideshows!</b> <div style="font-size:14px;margin-top:5px;">Thank you for trying it out, I hope you will find it useful.</div>',
          
            3:'<b>It all sounds complicated but I designed it to be easy to use...</b> <div style="font-size:14px;margin-top:5px;">No complicated HTML, just a few lines of jQuery!</div>',
       
        },
        links: { // Each image number must be listed here, unless no links are required at all, then links option can be ommitted.
            1:"",
            2:"",
            3:"",
           
        },
        linksOpen:'newWindow',
        timerInterval: 5000, // 5000 = 5 seconds
	randomise: false // Start with random image?
    };

    // Woo! We have a jquery slideshow plugin!
    $('#easy-container').easySlides(myOptions);

})
