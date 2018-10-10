	var dropdown = document.getElementsByClassName("dropdown-btn");
	var dropdownContent = document.getElementsByClassName("dropdown-container");
	var i;

	for (i = 0; i < dropdown.length; i++) {
  		dropdown[i].addEventListener("click", function() {
    	this.classList.toggle("active");
    	elementoPai = this.parentElement;
    	dropdownC = elementoPai.nextElementSibling;
    	console.log(dropdownC);
    if (dropdownC.style.display === "block") {
      dropdownC.style.display = "none";
    } else {
      dropdownC.style.display = "block";
     }
  });
}