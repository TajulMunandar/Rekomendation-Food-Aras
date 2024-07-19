import './bootstrap';
import 'flowbite';

// notif

setTimeout(function() {
    document.getElementById('notif').style.display = 'none';
}, 10000); // <-- time in milliseconds

document.getElementById('close-notif').addEventListener('click', function() {
    document.getElementById('notif').style.display = 'none';
});