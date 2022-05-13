//handel edit post part 
function edit(postId) {
    document.getElementById("editPart" + postId).style.display = "flex";
};

//close the edit part
function closeHandel(postId) {
    document.getElementById("editPart" + postId).style.display = "none";
};

//insert image 
function addPostImage() {
    document.getElementById("postImage").style.display = "flex";
};
//add image handel 
function addImage(postId) {
    document.getElementById("image" + postId).style.display = "flex";
};

//suggested friends handel on home page 
function iconClickHandel() {
    document.getElementById("friendIcon").style.color = "lightblue";
    document.getElementById("friendsPart").style.display = "flex";
}
//close suggested friends on home page
function closeFriendsHandel() {
    document.getElementById("friendIcon").style.color = "white";
    document.getElementById("friendsPart").style.display = "none";
}

// friends handel on profile page 
function friendIconHandel() {
    document.getElementById("friendsIcon").style.color = "lightblue";
    document.getElementById("friends").style.display = "flex";
}
//close friends on profile page 
function closeFriendHandel() {
    document.getElementById("friendsIcon").style.color = "white";
    document.getElementById("friends").style.display = "none";
}

//comment handler
function commentsHandel(postId) {
    document.getElementById("postReact" + postId).style.borderBottom = "1px solid gray";
};

//comments handel using AJAX
function commentHandel(postId) {
    var xmlhttp;
    if (window.XMLHttpRequest) {   // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {  // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("commentPart"+postId).innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "commentList.php?postId="+postId, true);
    xmlhttp.send();
}

