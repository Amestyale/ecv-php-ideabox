
let offset = 6

function getNextCards(){
    fetch(`/api/idees/${offset}`)
    .then(function(response) {
        return response.text();
    })
    .then(function(text) {
        if(text.length == 0){
            document.querySelector(".js-showmore").remove()
            return false
        }
        offset += 6
        document.querySelector('.js-cards').innerHTML += text
    });
}

document.querySelector(".js-showmore").addEventListener("click", ()=>{
    getNextCards()
})