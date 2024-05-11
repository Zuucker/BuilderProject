let overlayImageIndex = 0;
let startX;
let startY;

const toggleRecord = (event) => {
	const parentDiv = event.currentTarget;
	const controlsDiv = [...parentDiv.childNodes].filter((node) => node.tagName === "DIV" && node.classList.contains("invisible"))[0];

	if (
		controlsDiv &&
		controlsDiv.style &&
		(controlsDiv.style.display === "none" || controlsDiv.style.display === "")
	) {
		const allRecords = [...document.getElementsByClassName("record")];
		allRecords.forEach((r) => {
			r.childNodes[3].style.display = "none";
		});
		controlsDiv.style.display = "block";
	} else if (
		controlsDiv &&
		controlsDiv.style &&
		!(controlsDiv.style.display === "none" || controlsDiv.style.display === "")
	) {
		controlsDiv.style.display = "none";
	}
};

const toggleOverlay = () => {
	const overlayDiv = document.getElementsByClassName("overlay")[0];
	if (overlayDiv.style.display === "none" || overlayDiv.style.display === "") {
		overlayDiv.style.display = "flex";
	} else {
		overlayDiv.style.display = "none";
	}
};

const expandMiniature = (path) => {
	toggleOverlay();
	const img = document.getElementById("preview");
	if (img) {
		img.src = path;
		const allImages = [...document.getElementsByTagName("IMG")];
		const images = allImages.filter((img) => img.onclick);
		overlayImageIndex = images.findIndex((img) =>
			img.src.includes(path.split("/").pop())
		);
	}
};

const toggleAddition = (e) => {
	e.preventDefault();

	const newInput = document.getElementById("newNameInput");
	const additionButton1 = document.getElementById("additionButton1");
	const additionButton2 = document.getElementById("additionButton2");
	const additionButton3 = document.getElementById("additionButton3");

	if (newInput.style.display === "none" || newInput.style.display === "") {
		newInput.style.display = "block";
		additionButton1.style.display = "block";
		additionButton2.style.display = "none";
		additionButton3.style.display = "block";
	} else {
		newInput.style.display = "none";
		additionButton1.style.display = "none";
		additionButton2.style.display = "block";
		additionButton3.style.display = "none";
	}
};

const handleClick = (argument, fileName) => {
	document.getElementById("firstArg").value = fileName;

	document.getElementById("submitButton").name = "changeName";
	if (argument === "changeName") {
		document.getElementById("secondArg").style.display = "block";
		document.getElementById("submitButton").innerHTML = "Zmień nazwę";
	} else if (argument === "delete") {
		document.getElementById("firstArg").style.display = "none";
		document.getElementById("secondArg").style.display = "none";
		document.getElementById("submitButton").innerHTML = "Usuń";
	} else if (argument === "addFiles") {
		document.getElementById("files").click();
		document.getElementById("firstArg").style.display = "none";
		document.getElementById("secondArg").style.display = "none";
		document.getElementById("submitButton").style.display = "none";
		argument = "upload";
	}
	toggleOverlay();

	setTimeout(() => {
		document.getElementById("submitButton").name = argument;
	}, 20);
};

const scrollToSection = (section) => {
	const target = document.getElementById(section);
	const scrollTop = window.scrollY || document.documentElement.scrollTop;
	const absoluteTop = target.getBoundingClientRect().top + scrollTop;

	const vh = window.innerHeight / 100;

	if (target) {
		let dist = absoluteTop - 8 * vh;

		if (section === "moreRealizations") {
			dist -= 3 * vh;
		}

		window.scrollTo({
			top: dist,
			behavior: "smooth",
		});
	}
};

const redirectTo = (path) => {
	window.location.href = path;
};

const handleOverlayChange = (e) => {
	if (e.type === "click") {
		const parentBoundingBox = e.target.getBoundingClientRect();
		const middleLine = parentBoundingBox.left + parentBoundingBox.width / 2;

		if (e.clientX <= middleLine) {
			changeOverlayImage(-1);
		} else {
			changeOverlayImage(1);
		}
	} else if (e.type === "keydown") {
		if (e.key === "ArrowLeft") {
			changeOverlayImage(-1);
		} else if (e.key === "ArrowRight") {
			changeOverlayImage(1);
		}
	}
};

const changeOverlayImage = (arg) => {
	const allImages = [...document.getElementsByTagName("IMG")];
	const images = allImages.filter((img) => img.onclick);

	const contentDiv = document.getElementsByClassName("content")[0];
	const oldImg = document.getElementById("preview");

	const width = contentDiv.getBoundingClientRect().width;
	const height = oldImg.getBoundingClientRect().height;

	if (arg === -1) {
		if (overlayImageIndex === 0) {
			overlayImageIndex = images.length - 2;
		} else {
			overlayImageIndex--;
		}
	} else if (arg === 1) {
		if (overlayImageIndex === images.length - 2) {
			overlayImageIndex = 0;
		} else {
			overlayImageIndex++;
		}
	}

	const img = document.getElementById("preview");
	img.src = images[overlayImageIndex].src.replace("miniatury/", "");
};

const handleTouchStart = (e) => {
	const overlayDiv = document.getElementsByClassName("overlay")[0];
	if (overlayDiv.style.display === "flex") {
		startX = e.touches[0].clientX;
		startY = e.touches[0].clientY;
	}
};

const handleTouchEnd = (e) => {
	const overlayDiv = document.getElementsByClassName("overlay")[0];
	if (overlayDiv.style.display === "flex") {
		if (!startX || !startY) {
			return;
		}

		const currentX = e.changedTouches[0].clientX;
		const currentY = e.changedTouches[0].clientY;
		const deltaX = currentX - startX;
		const deltaY = currentY - startY;

		if (Math.abs(deltaX) > Math.abs(deltaY)) {
			if (deltaX > 0) {
				changeOverlayImage(-1);
			} else {
				changeOverlayImage(1);
			}
		}

		startX = null;
		startY = null;
	}
};
