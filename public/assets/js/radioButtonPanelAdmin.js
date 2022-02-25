    
const radioButtons={
  pokemons:'none',
  especies:'none',
  tipos:'none',
  habilidades:'none',
  usuarios:'none',
  pokedex:'none'
};

const [values, setValues] = useState(radioButtons);

const table = localStorage.getItem('table') || '';
const searchtable = localStorage.getItem('searchtable') || 'pokemon';


if (table != '') {
  document.getElementById('pokemons').style=`display:none`;
  document.getElementById(table).style=`display:block`;
  document.getElementById('mytableSearch').value=`${searchtable}`;
 
  
}

const check=(value, mytableSearch)=>{
  
  
   localStorage.setItem('table',Object.keys(value)[0]);
   document.getElementById('mytableSearch').value=`${mytableSearch}`; 
   localStorage.setItem('searchtable',mytableSearch);
   
  
   setValues({...radioButtons, ...value});
    for (const div in values()) {
          document.getElementById(`${div}`).style=`display:${values()[div]}`;
        
    };
}


