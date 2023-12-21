function toggleReplyForm(id) {
    var form = document.getElementById('reply-form-' + id);
    var button = document.getElementById('reply-btn-' + id);
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
    button.style.display = form.style.display === 'none' ? 'block' : 'none';
}

function validateReply(id) {
    var input = document.querySelector('#reply-form-' + id + ' input[type="text"]');
    if (input.value.trim() === '') {
        alert('La réponse ne peut pas être vide.');
        return false;
    }
    return true;
}

function toggleReplies(commentId) {
    var repliesContainer = document.getElementById('replies-' + commentId);
    if (repliesContainer.style.display === 'none') {
        repliesContainer.style.display = 'block';
    } else {
        repliesContainer.style.display = 'none';
    }
}

function deleteComment(commentId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')) {
        window.location.href = 'deleteComment.php?id=' + commentId;
    }
}

function deleteResponse(responseId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette réponse ?')) {
        window.location.href = 'deleteResponse.php?id=' + responseId;
    }
}
