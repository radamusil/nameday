require('./bootstrap');



const name = document.getElementById('name');
const matchList = document.getElementById('match-list');
//get namedays and filter it
const searchNames = async searchText => {
    //fetch namedays from api point
    const res = await fetch('/getnamedays');
    const names = await res.json();
    
    //Get matches to current text input
     let matches = Object.values(names).filter(nameday => {
        const regex = new RegExp(`^${searchText}`, 'gi');
        return nameday.name.match(regex);
    });
    //clear sugestions if no input
    if(searchText.length === 0) {
        matches = [];
        matchList.innerHTML = '';
    }

    outputHtml(matches);
    
};
//put selected sugestion to input
const autoFill = (e) => {
    document.getElementById('city_name').value = e;
}
//display matching sugestions
const outputHtml = matches => {
    if(matches.length > 0) {
        const html = matches.map(match => `
            <div class="btn w-100 p-2 bg-white" onClick="document.getElementById('name').value = '${match.name}'; matches = [];
            document.getElementById('match-list').innerHTML = '';">
                <h4>${match.name}</h4>
            </div>
        `).join('');
        matchList.innerHTML = html;
    } else {
        matches = [];
        matchList.innerHTML = '';
    }
}
//get changes of input 
name.addEventListener('input', () => searchNames(name.value));

