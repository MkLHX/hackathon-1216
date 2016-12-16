
// *                       Appel Fonction
// ********************************************************************
jQuery(document).ready(function($) {

    console.log('jQuery de app.js a démarré et est opérationnel');

    // RETOUR VERS LE HAUT
    retour_haut();

    //NOTIFYME
    notifyMe();
});

// ********************************************************************
// *                       NotifyMe
// ********************************************************************

function notifyMe() {
    // Voyons si le navigateur supporte les notifications
    if (!("Notification" in window)) {
        alert("Ce navigateur ne supporte pas les notifications desktop");
    }

    // Voyons si l'utilisateur est OK pour recevoir des notifications
    else if (Notification.permission === "granted") {
        // Si c'est ok, créons une notification
        var notification = new Notification("Un challenge vient d'être accepté.");
    }

    // Sinon, nous avons besoin de la permission de l'utilisateur
    // Note : Chrome n'implémente pas la propriété statique permission
    // Donc, nous devons vérifier s'il n'y a pas 'denied' à la place de 'default'
    else if (Notification.permission !== 'denied') {
        Notification.requestPermission(function (permission) {

            // Quelque soit la réponse de l'utilisateur, nous nous assurons de stocker cette information
            if(!('permission' in Notification)) {
                Notification.permission = permission;
            }

            // Si l'utilisateur est OK, on crée une notification
            if (permission === "granted") {
                var notification = new Notification("Salut toi !");
            }
        });
    }

    // Comme ça, si l'utlisateur a refusé toute notification, et que vous respectez ce choix,
    // il n'y a pas besoin de l'ennuyer à nouveau.
}

// ********************************************************************
// *                       Bouton retour vers haut
// ********************************************************************

function retour_haut() {
    $('body').prepend('<a href="#" class="back-to-top">Back to Top</a>');

    var amountScrolled = 300;

    $(window).scroll(function () {
        if ($(window).scrollTop() > amountScrolled) {
            $('a.back-to-top').fadeIn('slow');
        } else {
            $('a.back-to-top').fadeOut('slow');
        }
    });

    $('a.back-to-top, a.simple-back-to-top').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 700);
        return false;
    });
}

// ********************************************************************
// *                       Facebook
// ********************************************************************

function facebook() {

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
}













