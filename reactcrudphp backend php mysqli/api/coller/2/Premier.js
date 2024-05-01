import React, { useState, useEffect } from 'react';

function Premier() {
  const [purchases, setPurchases] = useState([]);

  useEffect(() => {
    fetchPurchases();
  }, []);

  const fetchPurchases = () => {
    fetch('http://localhost/reactcrudphp/api/purchase.php')
      .then(response => response.json())
      .then(data => setPurchases(data))
      .catch(error => console.error('Error fetching purchases:', error));
  };

  return (
    <div>
      <h1>Purchases</h1>
      <ul>
        {purchases.map((purchase, index) => (
          <li key={index}>
            <p>Refclient: {purchase.refclient} --- Buyer Name: {purchase.buyer_name}</p>
            <p>Products:</p>
            <ul>
              {purchase.product_ids.map((productId, index) => (
                <li key={index}>Product ID: {productId} --- Quantity: {purchase.quantities[index]}</li>
              ))}
            </ul>
          </li>
        ))}
      </ul>
    </div>
  );
}

export default Premier;