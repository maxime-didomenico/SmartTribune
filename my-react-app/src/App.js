import React, { useState } from 'react';
import Results from './Results';
import './App.css';

function App() {
  const [url, setUrl] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();

    // Envoi de la requête cURL avec l'URL saisie
    fetch('http://localhost:8000/api/puppeteer', {
      method: 'POST',
      body: url,
    })
      .then(response => response.json())
      .then(data => {
        // Traiter la réponse
        console.log(data);
      })
      .catch(error => {
        // Gérer les erreurs
        console.error(error);
      });
  };

  return (
    <div className="App">
      <h1 className="App-title">Monitoring App</h1>
      <form onSubmit={handleSubmit}>
        <input
          type="text"
          value={url}
          onChange={e => setUrl(e.target.value)}
          placeholder="Entrez une URL"
        />
        <button type="submit">Ajouter</button>
      </form>
      <Results />
    </div>
  );
}

export default App;
