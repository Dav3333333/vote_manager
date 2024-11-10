const form = document.querySelector(".election-container")
const entry = form.querySelector("#card")
const control_text = form.querySelector("#control-card")

entry.focus()

entry.addEventListener("keyup", (e)=>{
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
    e.stopPropagation()
})

function xhrControlCard(cardCode) {
    let xhr = new XMLHttpRequest()
    xhr.open("POST", "php/apis/validate_card.php")
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
            control_text.innerHTML =  xhr.responseText
            if(xhr.responseText === "valid"){
                document.location.href = "?page=vote"
                entry.value = ""
            }
        }
    }
    let formData = new FormData(form)
    xhr.send(formData)
}

// d.length


