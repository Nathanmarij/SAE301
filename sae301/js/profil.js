
function toggleInput(fieldId) {
    var input = document.getElementById(fieldId);
    var button = document.querySelector('button[onclick="toggleInput(\'' + fieldId + '\')"]');
    input.style.display = input.style.display === 'none' ? 'block' : 'none';
    button.style.display = 'none';
}