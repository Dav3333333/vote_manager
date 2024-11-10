<div class="container">
    <div class="admin-container">
        <div class="candidates">
            <h2>Enrolement</h2>
            <div class="enrolecandidates">
                <div class="list-cand">
                    
                </div>
                <!-- here we must charge things with and api  -->
                <form action="#" class="enrole-form" methode="POST" multi>
                    <div class="names">
                        <input type="text" name="name" id="name" placeholder="Entrer le nom du candidat" autocomplete="off" required>
                        <input type="text" name="second-name" id="seconde-name" placeholder="Entrer son second nom" autocomplete="off" required>
                    </div>
                    <div class="image-enrole">
                        <input type="file" name="image" id="image" accept=".png,.PNG,.JPG,.jpg,.jpeg,.JPEG" required>
                    </div>
                    <div class="enrole-buttons">
                        <input type="submit" value="Enroler" id="submit">
                        <button id="finish-enrol">Terminer</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-generating">
            <h2>Creation des bllets de vote</h2>
            <div class="div-generator">
                <form action="#" class="card-generator" methode="POST">
                    <label for="card_number">Entrer le nombre des billets</label>
                    <input type="number" name="card_number" id="card_number" required>
                    <input type="submit" value="Generer" id="sub_gen_card">
                </form>
                <div class="feedbacks">
                    <span>Le document nomme xxxxx contient les code des billets de vote</span>
                    <p>
                        Vous etes presque a l'etape d'autoriser le votec veuillez vous rassurer que vous avec 
                        imprimer et bien telecharger le donnes des card pour ouvrir 
                        avec l'activite de vote sur le system.,<br>
                        Pour commencer veuiller suivre les etapes suivantes
                    </p>
                </div>
            </div>
        </div>
        <div class="vote-auth">
            <h2>Fin et autorisation de vote</h2>
            <form class="pswd_manager">
                <input type="password" name="admin_pass" id="admin_pass" placeholder="Entrer le mot de pass admin">
                <input type="submit" value="Commencer Le vote" id="sub_admin_pass">
            </form>
        </div>
    </div>
</div>

<script src="js/admin.js"></script>