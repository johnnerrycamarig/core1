import { createContext, ReactNode, useContext, useEffect, useMemo, useState } from 'react';
import { login as loginApi, register as registerApi, verifyMfa as verifyMfaApi, AuthResponse } from '../services/api';

type User = { id: number; name: string; email: string } | null;

interface AuthContextValue {
  user: User;
  loading: boolean;
  mfaRequired: boolean;
  login: (email: string, password: string) => Promise<AuthResponse>;
  register: (name: string, email: string, password: string, password_confirmation: string) => Promise<AuthResponse>;
  verifyMfa: (email: string, code: string) => Promise<AuthResponse>;
  logout: () => void;
}

const AuthContext = createContext<AuthContextValue | undefined>(undefined);

export function AuthProvider({ children }: { children: ReactNode }) {
  const [user, setUser] = useState<User>(null);
  const [loading, setLoading] = useState(true);
  const [mfaRequired, setMfaRequired] = useState(false);

  useEffect(() => {
    const token = localStorage.getItem('intellitrack_token');
    if (token) {
      const userJson = localStorage.getItem('intellitrack_user');
      if (userJson) {
        setUser(JSON.parse(userJson));
      }
    }
    setLoading(false);
  }, []);

  const login = async (email: string, password: string) => {
    const data = await loginApi(email, password);
    if (data.token) {
      localStorage.setItem('intellitrack_token', data.token);
      localStorage.setItem('intellitrack_user', JSON.stringify(data.user));
      setUser(data.user);
      setMfaRequired(false);
    }
    if (data.mfa_required) {
      setMfaRequired(true);
    }
    return data;
  };

  const register = async (name: string, email: string, password: string, password_confirmation: string) => {
    const data = await registerApi(name, email, password, password_confirmation);
    if (data.token) {
      localStorage.setItem('intellitrack_token', data.token);
      localStorage.setItem('intellitrack_user', JSON.stringify(data.user));
      setUser(data.user);
    }
    return data;
  };

  const verifyMfa = async (email: string, code: string) => {
    const data = await verifyMfaApi(email, code);
    if (data.token) {
      localStorage.setItem('intellitrack_token', data.token);
      localStorage.setItem('intellitrack_user', JSON.stringify(data.user));
      setUser(data.user);
      setMfaRequired(false);
    }
    return data;
  };

  const logout = () => {
    localStorage.removeItem('intellitrack_token');
    localStorage.removeItem('intellitrack_user');
    setUser(null);
  };

  const value = useMemo(
    () => ({ user, loading, mfaRequired, login, register, verifyMfa, logout }),
    [user, loading, mfaRequired]
  );

  return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>;
}

export function useAuth() {
  const context = useContext(AuthContext);
  if (!context) {
    throw new Error('useAuth must be used within AuthProvider');
  }
  return context;
}
