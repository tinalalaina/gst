import React, { useState, useEffect } from 'react';
import axios from 'axios';

const Premier = () => {
  const [products, setProducts] = useState([]);
  const [cart, setCart] = useState([]);
  const [buyerName, setBuyerName] = useState('');

  useEffect(() => {
    fetchProducts();
  }, []);

  const fetchProducts = async () => {
    try {
      const response = await axios.get('http://localhost/reactcrudphp/api/products.php');
      setProducts(response.data);
    } catch (error) {
      console.error('Error fetching products:', error);
    }
  };

  const addToCart = (product) => {
    const existingItem = cart.find((item) => item.id === product.id);
    if (existingItem) {
      if (existingItem.quantity < product.stock) {
        setCart(cart.map(item => item.id === product.id ? {...item, quantity: item.quantity + 1} : item));
      } else {
        alert("Not enough stock available");
      }
    } else {
      setCart([...cart, { ...product, quantity: 0 }]);
    }
  };

  const removeFromCart = (productId) => {
    setCart(cart.filter(item => item.id !== productId));
  };

  const decreaseQuantity = (productId) => {
    const updatedCart = cart.map(item =>
      item.id === productId && item.quantity > 1
        ? { ...item, quantity: item.quantity - 1 }
        : item
    );
    setCart(updatedCart);
  };

  const calculateTotalPrice = () => {
    return cart.reduce((total, item) => total + (item.price * item.quantity), 0);
  };

  const confirmPurchase = async () => {
    if (!buyerName) {
      alert('Please enter your name to confirm the purchase.');
      return;
    }
    const confirmation = window.confirm('Are you sure you want to confirm this purchase?');
    if (confirmation) {
      try {
        const cartWithBuyerName = cart.map(item => ({ ...item, buyerName }));
        const response = await axios.post('http://localhost/reactcrudphp/api/1/purchase.php', { cart: cartWithBuyerName });
        setCart([]);
        alert(response.data);
      } catch (error) {
        console.error('Error confirming purchase:', error);
        alert('Failed to confirm purchase. Please try again later.');
      }
    }
  };

  return (
    <div>
      <h1>Product List</h1>
      <ul>
        {products.map((product) => (
          <li key={product.id}>
            {product.name} - ${product.price} - Stock: {product.stock}
            <button onClick={() => addToCart(product)}>Add to Cart</button>
          </li>
        ))}
      </ul>
      <h2>Cart</h2>
      <ul>
        {cart.map((item) => (
          <li key={item.id}>
            {item.name} - ${item.price} - Quantity: {item.quantity} - Total: ${item.price * item.quantity}
            <button onClick={() => decreaseQuantity(item.id)}>-</button>
            <button onClick={() => removeFromCart(item.id)}>Remove</button>
          </li>
        ))}
      </ul>
      <h3>Total: ${calculateTotalPrice()}</h3>
      <input 
        type="text" 
        placeholder="Your Name"
        value={buyerName}
        onChange={(e) => setBuyerName(e.target.value)}
      />
      <button onClick={confirmPurchase}>Confirm Purchase</button>
    </div>
  );
};

export default Premier;