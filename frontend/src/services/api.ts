import axios from 'axios';

const API_BASE = import.meta.env.VITE_API_BASE_URL ?? 'http://localhost:8000/api';

const api = axios.create({
  baseURL: API_BASE,
  headers: {
    'Content-Type': 'application/json',
  },
  withCredentials: true,
});

api.interceptors.request.use((config) => {
  const token = localStorage.getItem('intellitrack_token');
  if (token && config.headers) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

export type AuthResponse = {
  user: { id: number; name: string; email: string };
  token: string;
  mfa_required?: boolean;
};

export const login = async (email: string, password: string) => {
  const response = await api.post<AuthResponse>('/auth/login', { email, password });
  return response.data;
};

export const register = async (name: string, email: string, password: string, password_confirmation: string) => {
  const response = await api.post<AuthResponse>('/auth/register', {
    name,
    email,
    password,
    password_confirmation,
  });
  return response.data;
};

export const verifyMfa = async (email: string, code: string) => {
  const response = await api.post<AuthResponse>('/auth/mfa/verify', { email, code });
  return response.data;
};

export const fetchClients = async () => {
  const response = await api.get('/clients');
  return response.data;
};

export const fetchJobOrders = async () => {
  const response = await api.get('/job-orders');
  return response.data;
};

export type DashboardMetrics = {
  clients: number;
  active_jobs: number;
  rentals: number;
  projects: number;
};

export const fetchDashboardMetrics = async (): Promise<DashboardMetrics> => {
  const response = await api.get<DashboardMetrics>('/dashboard/metrics');
  return response.data;
};

export const logout = async () => {
  await api.post('/auth/logout');
  localStorage.removeItem('intellitrack_token');
};

export default api;
