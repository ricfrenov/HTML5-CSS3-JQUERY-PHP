
startList = function() {
if (document.all&&document;.getElementById) {
navRoot = document.getElementById("nav");
for (i=0; i;
if (node.nodeName=="LI") {
node.onmouseover=function() {
this.className+=" over";
  } 
node.onmouseout=function(){ {
  this.className=this.className.replace(" over", "");
   }
   }
   }
   }
   }
window.onload=startList;
