let thumbnail = document.getElementsByClassName("thumbnail");
let slider = document.getElementById("slider");

const maxScrollLeft = slider.scrollWidth - slider.clientWidth;

function autoPlay() {
	if(slider.scrollLeft > (maxScrollLeft - 1)) {
		slider.scrollLeft -= maxScrollLeft;
	} else {
		slider.scrollLeft += 1;
	}
}

let play = setInterval(autoPlay, 20);

for(let i = 0; i < thumbnail.length; i++) {
	thumbnail[i].addEventListener("mouseover",(e) => {
	  clearInterval(play)
	});

	thumbnail[i].addEventListener("mouseout", () => {
		return play = setInterval(autoPlay, 20)
	})
}



const bodyText = document.getElementById('text_h1');

let i = 0;
function writeText() {
    bodyText.innerText = text.slice(0, i);

    i++;

    if(i > bodyText.length + 1) {
        i = 0;
    }
}

setInterval(writeText, 1000);