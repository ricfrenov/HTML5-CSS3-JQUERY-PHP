
$(document).ready(function(){

    // Set up our options for the slideshow...
    var myOptions = {
        noImages: 3,
        path: "images/slide/",  // Relative path with trailing slash.
        captions: {    
          1:'<b>Conheça Nossas Unidades e Infraestrutura</b><div style="font-size:14px;margin-top:5px;">Estude na melhor Instituição de Ensino em Camaçari.</div>',
                     
            2:'<b>Conheça Nossas Unidades e Infraestrutura</b><div style="font-size:14px;margin-top:5px;">Estude na melhor Instituição de Ensino em Camaçari.</div>',
          
            3:'<b>NOTÍCIAS use...</b><div style="font-size:14px;margin-top:5px;">NOTÍCIAS!</div>',
       
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

$(document).ready(function(){	
	$("#slider").easySlider({
		auto: true,
		continuous: true,
		nextId: "slider1next",
		prevId: "slider1prev"
	});
	$("#slider2").easySlider({ 
		numeric: true
	});
});
