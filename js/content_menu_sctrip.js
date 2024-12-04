const targetElement = document.getElementById('targetElement');
const contextMenu = document.getElementById('contextMenu');
const menuItems = document.getElementById('menuItems');

// Définir les éléments du menu avec leurs actions
const menuOptions = [
    { title: "Commande 1", action: customFunction1 },
    { title: "Commande 2", action: customFunction2 },
    { title: "Commande 3", action: customFunction3 }
];

// Fonction pour afficher le menu contextuel
targetElement.addEventListener('contextmenu', function(event) {
    event.preventDefault(); // Empêche le menu contextuel par défaut

    // Positionner le menu contextuel
    const { clientX: mouseX, clientY: mouseY } = event;
    contextMenu.style.left = `${mouseX}px`;
    contextMenu.style.top = `${mouseY}px`;

    // Remplir le menu avec les options
    renderMenu(menuOptions);

    // Afficher le menu
    contextMenu.classList.remove('hidden');
});

// Fermer le menu si on clique ailleurs
window.addEventListener('click', function(event) {
    if (!contextMenu.contains(event.target) && !targetElement.contains(event.target)) {
        contextMenu.classList.add('hidden');
    }
});

// Fonction pour rendre les éléments du menu
function renderMenu(options) {
    menuItems.innerHTML = ''; // Vider le contenu précédent
    options.forEach(option => {
        const li = document.createElement('li');
        li.textContent = option.title;
        li.onclick = option.action; // Associer l'action à l'élément de menu
        menuItems.appendChild(li);
    });
}

// Fonctions personnalisées pour les commandes
function customFunction1() {
    console.log("Commande 1 exécutée !");
}

function customFunction2() {
    console.log("Commande 2 exécutée !");
}

function customFunction3() {
    console.log("Commande 3 exécutée !");
}