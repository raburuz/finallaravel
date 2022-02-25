const addMoreFields=()=>{
    const parentNode = document.querySelector('#form');
    const div = document.querySelector('.clone');
    const cloneDiv = div.cloneNode(true);
    const nodeList = cloneDiv.childNodes;
    const myInputText = nodeList[3];
    myInputText.value = "";
    parentNode.insertBefore(cloneDiv,div);
}
  