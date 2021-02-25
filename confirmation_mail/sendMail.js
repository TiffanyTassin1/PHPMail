//POSSIBILITE AVEC JS
// function sendMail() {
//     let prenom = $("prenom");
//     let nom    = $("nom");
//     let mail   = $("mail");

//     if(isNotEmpty(nom) && isNotEmpty(prenom) && isNotEmpty(mail)) {
//         $.ajax({
//             url: "mail.php",
//             method: "POST",
//             dataType: "json",
//             data:{
//                 nom: nom.val(),
//                 prenom: prenom.val(),
//                 mail: mail.val(),
//             }, success: function(response){
//                 $("#myForm")[0].reset();
//             }
//         });
//     }
// }

// console.log(sendMail);