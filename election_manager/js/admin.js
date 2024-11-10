const api_base_url = 'php/apis/'

// **************** elements of the page admin *****************

const admin = document.querySelector(".admin-container")
const admin_candidates = admin.querySelector(".candidates")
const admin_card_generating = admin.querySelector(".card-generating")

// enrolement elements
const admin_list_cand = admin_candidates.querySelector(".list-cand")
const candidate_enrole_form = admin_candidates.querySelector(".enrole-form")
const candidate_close_erole = admin_candidates.querySelector(".finish-enrol")

// card generating element
const card_generate_form = admin_card_generating.querySelector(".card-generator") 
const input_card_number = card_generate_form.querySelector("#card_number")

// *************** this first part to create functions of the pages *************

// get candidates function
function get_candidates() {
    let xhr = new XMLHttpRequest()
    xhr.open("GET", api_base_url+"get_candidates.php")
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
            // adding response to the innerHtml of the list candidate
            admin_list_cand.innerHTML = xhr.responseText
            // vote_action_listener()
        }
    }

    xhr.send()
}


// enrole logic function
function enrole_form_submit(){
    candidate_enrole_form.addEventListener("submit", (e)=>{
        e.preventDefault()
        e.stopPropagation()
        //call the fucntion of enrole
        let xhr = new XMLHttpRequest()
        xhr.open("POST", api_base_url+"add_candidates.php")
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
                if(xhr.responseText === "true"){
                    get_candidates()
                }else{
                    
                }
            }
        }
        let form = new FormData(candidate_enrole_form)
        xhr.send(form)
    })
}

function close_form_enrole() {
    candidate_close_erole.addEventListener("click", (e)=>{
        e.stopPropagation()
        admin_candidates.style.backgroundColor = "rgba(0, 0, 0, 0.719)"
        candidate_enrole_form.addEventListener("click", (e)=>{
            e.stopPropagation()
            e.preventDefault()
        })
        candidate_enrole_form.removeEventListener("submit", (e)=>{
            e.defaultPrevented()
        })
    })
    // adding the focus to input_card_number for generating 
    input_card_number.focus()
}

// ************* generating card functions

function generating_card(){
    card_generate_form.addEventListener("submit", (e)=>{
        e.preventDefault()
        e.stopPropagation()

        let xhr = new XMLHttpRequest()
        xhr.open("POST", api_base_url+"generate_cards.php")
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
                if(xhr.responseText === "true"){
                    // here we put the function to hide also this part of generating card
                    input_card_number.value = ""
                }
            }

            console.log(xhr.responseText)
        }

        let card_form = new FormData(card_generate_form)
        xhr.send(card_form)
    })
}


// console.log(xhr.responseText)
// let div = document.createElement('div')
// div.innerHTML = xhr.responseText
// div.style.display = "block"
// div.style.left = "50%"
// div.style. alignSelf = "center"
// div.style.color = 'red'
// candidate_enrole_form.appendChild(div)

// calling functions space and listeners


// *********** contol state admin page function
function control_functions(steep) {
    // this function allow the admin to see were he is in configuration
    if(0 < steep && steep >= 3 ){
        if (steep === 1){
            get_candidates()
            enrole_form_submit(steep)
            close_form_enrole(steep)
            control_functions(steep)
            steep += 1
        }else if(steep === 2){

            steep += 1
            control_functions(steep)
        }
    }
}

// let steep = 1

// enrole_form_submit(steep)

console.log(card_generate_form)
generating_card()

