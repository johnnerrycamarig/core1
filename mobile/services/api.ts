const API_BASE = 'http://10.0.2.2:8000/api';

async function request(path: string, options: RequestInit = {}) {
  const response = await fetch(`${API_BASE}${path}`, {
    ...options,
    headers: {
      'Content-Type': 'application/json',
      ...(options.headers || {}),
    },
  });

  const data = await response.json();
  if (!response.ok) {
    throw new Error(data.message || 'API request failed');
  }
  return data;
}

export async function login(email: string, password: string) {
  return request('/auth/login', {
    method: 'POST',
    body: JSON.stringify({ email, password }),
  });
}

export async function register(name: string, email: string, password: string, password_confirmation: string) {
  return request('/auth/register', {
    method: 'POST',
    body: JSON.stringify({ name, email, password, password_confirmation }),
  });
}

export async function verifyMfa(email: string, code: string) {
  return request('/auth/mfa/verify', {
    method: 'POST',
    body: JSON.stringify({ email, code }),
  });
}

export async function fetchClients(token: string) {
  return request('/clients', {
    method: 'GET',
    headers: { Authorization: `Bearer ${token}` },
  });
}

export async function fetchJobOrders(token: string) {
  return request('/job-orders', {
    method: 'GET',
    headers: { Authorization: `Bearer ${token}` },
  });
}
