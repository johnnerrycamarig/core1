import React, { createContext, ReactNode, useContext, useEffect, useMemo, useState } from 'react';
import AsyncStorage from '@react-native-async-storage/async-storage';
import * as api from '../services/api';

type User = { id: number; name: string; email: string } | null;

type AuthResponse = {
  user: User;
  token?: string;
  mfa_required?: boolean;
};

interface AuthContextValue {
  user: User;
  token: string | null;
  loading: boolean;
  login: (email: string, password: string) => Promise<AuthResponse>;
  register: (name: string, email: string, password: string, password_confirmation: string) => Promise<AuthResponse>;
  verifyMfa: (email: string, code: string) => Promise<AuthResponse>;
  logout: () => Promise<void>;
}

const AuthContext = createContext<AuthContextValue | undefined>(undefined);

export function AuthProvider({ children }: { children: ReactNode }) {
  const [user, setUser] = useState<User>(null);
  const [token, setToken] = useState<string | null>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    (async () => {
      const storedToken = await AsyncStorage.getItem('intellitrack_token');
      const storedUser = await AsyncStorage.getItem('intellitrack_user');
      if (storedToken && storedUser) {
        setToken(storedToken);
        setUser(JSON.parse(storedUser));
      }
      setLoading(false);
    })();
  }, []);

  const login = async (email: string, password: string) => {
    const response = await api.login(email, password);
    if (response.token) {
      setToken(response.token);
      setUser(response.user);
      await AsyncStorage.setItem('intellitrack_token', response.token);
      await AsyncStorage.setItem('intellitrack_user', JSON.stringify(response.user));
    }
    return response;
  };

  const register = async (name: string, email: string, password: string, password_confirmation: string) => {
    const response = await api.register(name, email, password, password_confirmation);
    if (response.token) {
      setToken(response.token);
      setUser(response.user);
      await AsyncStorage.setItem('intellitrack_token', response.token);
      await AsyncStorage.setItem('intellitrack_user', JSON.stringify(response.user));
    }
    return response;
  };

  const verifyMfa = async (email: string, code: string) => {
    const response = await api.verifyMfa(email, code);
    if (response.token) {
      setToken(response.token);
      setUser(response.user);
      await AsyncStorage.setItem('intellitrack_token', response.token);
      await AsyncStorage.setItem('intellitrack_user', JSON.stringify(response.user));
    }
    return response;
  };

  const logout = async () => {
    await AsyncStorage.removeItem('intellitrack_token');
    await AsyncStorage.removeItem('intellitrack_user');
    setToken(null);
    setUser(null);
  };

  const value = useMemo(
    () => ({ user, token, loading, login, register, verifyMfa, logout }),
    [user, token, loading]
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
