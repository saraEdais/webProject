//handel edit post part 
function edit(postId){
    document.getElementById("editPart"+postId).style.display="flex";
};

//close the edit part
function closeHandel(postId){
    document.getElementById("editPart"+postId).style.display="none";
};

//comment handler
function commentHandel(postId) {
     document.getElementById("commentPart"+postId).style.display="flex";
     document.getElementById("postReact"+postId).style.borderBottom="1px solid gray";
};

//add image handel 
function addImage (postId){
    document.getElementById("image"+postId).style.display="flex";
};

// //suggested friends handel on home page 
// document.getElementById("friendIcon").onclick=function(){
//     document.getElementById("friendIcon").style.color="lightblue";
//     document.getElementById("friendsPart").style.display="flex";
// }
// //close suggested friends on home page
// document.getElementById("closeFriendsList").onclick=function(){
//     document.getElementById("friendIcon").style.color="white";
//     document.getElementById("friendsPart").style.display="none";
// }

//suggested friends handel on profile page 
// document.getElementById("friendIcon").onclick=function(){
//     document.getElementById("friendIcon").style.color="lightblue";
//     document.getElementById("friends").style.display="flex";
// }
//close suggested friends on profile page 
// document.getElementById("closeFriendList").onclick=function(){
//     document.getElementById("friendIcon").style.color="white";
//     document.getElementById("friends").style.display="none";
// }
