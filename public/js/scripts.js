/**
 * Created by darke_000 on 03.07.2016.
 */
function answer(id)
{
    document.getElementById("comment_pid").value = id;
}

function scrollToElement(theElement) {
    if (typeof theElement === "string") theElement = document.getElementById(theElement);
    var selectedPosX = 0;
    var selectedPosY = 0;
    while (theElement != null) {
        selectedPosX += theElement.offsetLeft;
        selectedPosY += theElement.offsetTop;
        theElement = theElement.offsetParent;
    }
    window.scrollTo(selectedPosX,selectedPosY)
}

function deleteComment(id)
{
    var xhr = new XMLHttpRequest();
    xhr.open('DELETE', "/comment/"+id, true);
    xhr.send();
}