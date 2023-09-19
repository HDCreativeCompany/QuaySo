
function goToLink(text) {
    switch (text) {
        case 'spin':
            window.location.href = 'views/luckydraw.php';
            break;
        case 'setting':
            window.location.href = 'views/dashboard.php';
            break;
        default:
            // Handle the default case if needed
            break;
    }
}

