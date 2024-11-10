let candidates = document.querySelectorAll(".candidate")
let list_candidates = document.querySelector(".list-candidates")

// functions here 
function vote_action_listener() {
    // redifine the candidates varible
    candidates = document.querySelectorAll(".candidate")
    // adding the event to each for created
    for (let i = 0; i < candidates.length; i++) {
        var cand = candidates[i]
        cand.addEventListener("submit", (e)=>{
            e.preventDefault()
            e.stopPropagation()
        })

        cand.addEventListener("click", (e)=>{
            if(confirm("voulez-vous vraiment votee XXXXX")){
                vote_processing(cand)
                alert("vote enregistrer")
            }
        })

    }
}

// funtion the manager the vote process for user front-end
function vote_processing(form) {
    let data = new FormData(form)
    let xhr = new XMLHttpRequest()
    xhr.open("POST", "php/apis/vote_processing")
    xhr.onload = ()=>{
        if(xhr.readyState === xhr.DONE && xhr.status === 200){
            console.log("every thing work")
        }else{
            console.log("something was wrong")
        }
    }
    xhr.send(data)
}

// function to get candidates from the server
function get_candidates() {
    let xhr = new XMLHttpRequest()
    xhr.open("GET", "php/apis/get_candidates.php")
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
            // adding response to the innerHtml of the list candidate
            list_candidates.innerHTML = xhr.responseText
            vote_action_listener()
        }
    }

    xhr.send()
}

get_candidates()