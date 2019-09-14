$('#add-image').click(function(){


    //Récuperater le numéro du nouveau champs que je vais créer
    const index = +$('#widgets-counter').val();

    //Récupèrer le prototype des entrées
    const tmpl = $('#annonce_images').data('prototype').replace(/__name__/g,index);
    
    //Injecter du code de la nouvelle image     
    $('#annonce_images').append(tmpl);
    $('#widgets-counter').val(index+1);
    //Gérer le button supprimer
    handleDeleteButtons();

});

function handleDeleteButtons(){
    $('button[data-action="delete"]').click(function(){
        const target = this.dataset.target;
        $(target).remove();
    });
}


function updateCounter(){
    const count =+$('#annonce_images div.form-group').length;
    $('#widgets-counter').val(count);
}
updateCounter();
handleDeleteButtons();