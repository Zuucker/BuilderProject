const toggleRecord = (event) =>{
    const parentDiv = event.target;
    const controlsDiv =  parentDiv.childNodes[1];
    if(controlsDiv && controlsDiv.style && (controlsDiv.style.display === 'none' || controlsDiv.style.display === ''))
    {
        const allRecords = [...document.getElementsByClassName('record')];
        allRecords.forEach(r => {
            r.childNodes[1].style.display='none';
        });
        controlsDiv.style.display='block';
    }
    else if(controlsDiv && controlsDiv.style && !(controlsDiv.style.display === 'none' || controlsDiv.style.display === '')){
        controlsDiv.style.display='none';
    }
}

const toggleOverlay = () =>{
    const overlayDiv = document.getElementsByClassName("overlay")[0];
    if(overlayDiv.style.display === 'none' || overlayDiv.style.display === '')
    {
        overlayDiv.style.display = 'block';
    }
    else
    {
        overlayDiv.style.display = 'none';
    }
}

const toggleAddition = (e) =>{

    e.preventDefault();

    const newInput = document.getElementById("newNameInput");
    const additionButton1 = document.getElementById("additionButton1");
    const additionButton2 = document.getElementById("additionButton2");
    const additionButton3 = document.getElementById("additionButton3");

    if(newInput.style.display === 'none' || newInput.style.display === '')
    {
        newInput.style.display = 'block';
        additionButton1.style.display = 'block';
        additionButton2.style.display = 'none';
        additionButton3.style.display = 'block';
    }
    else
    {
        newInput.style.display = 'none';
        additionButton1.style.display = 'none';
        additionButton2.style.display = 'block';
        additionButton3.style.display = 'none';
    }
}

const handleClick = (argument,fileName) => {
    document.getElementById("firstArg").value = fileName;
    document.getElementById("submitButton").name = argument;

    document.getElementById("submitButton").name = 'changeName';
    if(argument === "changeName"){
        document.getElementById("secondArg").style.display = 'block';
        document.getElementById("submitButton").innerHTML = "Zmień nazwę";
    }else if(argument === "delete"){
        document.getElementById("firstArg").style.display = 'none';
        document.getElementById("secondArg").style.display = 'none';
        document.getElementById("submitButton").innerHTML = "Usuń";
    }else if(argument === "addFiles"){
        document.getElementById("files").click();
        document.getElementById("firstArg").style.display = 'none';
        document.getElementById("secondArg").style.display = 'none';
        document.getElementById("submitButton").style.display = 'none';
        document.getElementById("submitButton").name = 'upload';
    }
    toggleOverlay();
}

const scrollToSection = (section) => {
    const target = document.getElementById(section);

    if(target){
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}