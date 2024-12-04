const form = document.querySelector(".election-container")
const entry = form.querySelector("#card")
const control_text = form.querySelector("#control-card")

/**
 * this function allows vote if it is allowed
 */
function getVote_auth() {
    let xhr = new XMLHttpRequest()
    xhr.open("GET", "php/apis/vote_auth.php")
    xhr.onload = ()=>{
        if(xhr.readyState === xhr.DONE && xhr.status === 200){
            let ans =  JSON.parse(xhr.responseText)
            if(ans['error'] !== undefined){
                const res = document.createElement("p")
                res.style.color = 'red'
                res.style.alignSelf = 'center'
                res.style.justifyContent ='center'
                res.innerHTML = ans['error']
                form.querySelector(".content").innerHTML = ""
                form.querySelector(".content").appendChild(res)
            }else{

            }
        }
    }
    xhr.send()
}


/**
 * functions that redirect user
 */

function xhrControlCard(cardCode) {
    let xhr = new XMLHttpRequest()
    xhr.open("POST", "php/apis/validate_card.php")
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
            if(xhr.responseText === "valid"){
                // as this doesnt work well I change something in the api space
                document.location.href = "vote?cardCode="+cardCode
                entry.value = ""
            }else{
                control_text.innerHTML =  xhr.responseText
            }
        }
    }
    let formData = new FormData(form)
    xhr.send(formData)
}

// scripts

entry.addEventListener("keyup", (e)=>{
    e.stopPropagation()
    if(entry.value.length > 0 && entry.value.length < 10){
        control_text.style.display = "block"
        control_text.textContent = "veuiller atteindre 10 caracterer"
    }else if(entry.value.length === 10){
        control_text.classList.add("done")
        control_text.textContent = "Merci veuiller patienter le traitement..."
        control_text.style.display = "block"
        xhrControlCard(entry.value)
    }else{
        control_text.style.display = "none"
        entry.value = ""
    }
})


getVote_auth()

entry.focus()


