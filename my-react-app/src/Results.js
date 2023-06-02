import React, { useState, useEffect } from 'react';
import './Results.css'; // Import du fichier CSS

function Results() {
  const [results, setResults] = useState([]);

  useEffect(() => {
    fetch('http://localhost:8000/api/results')
      .then(response => response.json())
      .then(data => setResults(data));
  }, []);

  const formatValue = (value) => {
    return value === "true" ? 'KO' : 'OK';
  };  

  const getColorClass = (value) => {
    return value === "true" ? 'result-true' : 'result-false';
  };  

  return (
    <table>
      <thead>
        <tr>
          <th>Link</th>
          <th>Site Down</th>
          <th>Product Down</th>
          <th>Product Misconfiguration</th>
        </tr>
      </thead>
      <tbody>
        {results.map(result => (
          <tr key={result.id}>
            <td>{result.link}</td>
            <td className={`${getColorClass(result.result1)}`}>{formatValue(result.result1)}</td>
            <td className={`${getColorClass(result.result2)}`}>{formatValue(result.result2)}</td>
            <td className={`${getColorClass(result.result3)}`}>{formatValue(result.result3)}</td>

          </tr>
        ))}
      </tbody>
    </table>
  );
}

export default Results;
