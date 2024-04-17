const toggleRecord = (event) =>{
    const parentDiv = event.target;
    const controlsDiv =  parentDiv.childNodes[1];
    if(controlsDiv.style && controlsDiv.style.display === 'none' || controlsDiv.style.display === '')
    {
        const allRecords = [...document.getElementsByClassName('record')];
        allRecords.forEach(r => {
            r.childNodes[1].style.display='none';
        });
        controlsDiv.style.display='block';
    }
    else{
        controlsDiv.style.display='none';
    }
}

const toggleOverlay = () =>{
    const overlayDiv = document.getElementsByClassName("overlay")[0];
    console.log(overlayDiv.style.display );
    if(overlayDiv.style.display === 'none' || overlayDiv.style.display === '')
    {
        overlayDiv.style.display = 'block';
    }
    else
    {
        overlayDiv.style.display = 'none';
    }
}

const handleClick = (argument) => {
    console.log(argument);
    document.getElementById("newFileName").value = document.getElementById("fileName").value;
    document.getElementById("submitButton").name = argument;

    if(argument === "changeName"){
        document.getElementById("submitButton").innerHTML = "Zmień nazwę";
        document.getElementById("secondArg").style.display = 'block';
    }else if(argument === "delete"){
        document.getElementById("secondArg").style.display = 'none';
        document.getElementById("submitButton").innerHTML = "Usuń";
    }
    toggleOverlay();
}