require('./bootstrap');



const name = document.getElementById('name');
const matchList = document.getElementById('match-list');
//Search obce.json and filter it
const searchNames = async searchText => {
    const res = await fetch('/getnamedays');
    const names = await res.json();
    console.log(names);
    //Get matches to current text input
     let matches = Object.values(names).filter(nameday => {
        const regex = new RegExp(`^${searchText}`, 'gi');
        return nameday.name.match(regex);
    });
    console.log(matches);

    if(searchText.length === 0) {
        matches = [];
        matchList.innerHTML = '';
    }

    outputHtml(matches);
    //console.log(matches); 
};

const autoFill = (e) => {
    document.getElementById('city_name').value = e;
}
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

name.addEventListener('input', () => searchNames(name.value));

