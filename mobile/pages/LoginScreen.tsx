import React, { useState } from 'react';
import { Alert, Button, Text, TextInput, TouchableOpacity, View } from 'react-native';
import { useAuth } from '../context/AuthContext';

interface Props {
  onRegister: () => void;
  onMfaRequired: (email: string) => void;
}

export default function LoginScreen({ onRegister, onMfaRequired }: Props) {
  const { login } = useAuth();
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [loading, setLoading] = useState(false);

  const handleLogin = async () => {
    setLoading(true);
    try {
      const result = await login(email, password);
      if (result.mfa_required) {
        onMfaRequired(email);
      }
    } catch (error: any) {
      Alert.alert('Login failed', error.message || 'Unable to login');
    } finally {
      setLoading(false);
    }
  };

  return (
    <View style={{ width: '100%' }}>
      <Text style={{ fontSize: 28, fontWeight: '700', marginBottom: 12 }}>IntelliTrack Sign In</Text>
      <Text style={{ color: '#64748b', marginBottom: 24 }}>Use your account credentials to access the dashboard.</Text>

      <Text style={{ marginBottom: 8, color: '#334155' }}>Email</Text>
      <TextInput
        value={email}
        onChangeText={setEmail}
        keyboardType="email-address"
        autoCapitalize="none"
        style={{
          borderColor: '#cbd5e1',
          borderWidth: 1,
          borderRadius: 16,
          padding: 14,
          marginBottom: 16,
          backgroundColor: '#fff',
        }}
      />

      <Text style={{ marginBottom: 8, color: '#334155' }}>Password</Text>
      <TextInput
        value={password}
        onChangeText={setPassword}
        secureTextEntry
        style={{
          borderColor: '#cbd5e1',
          borderWidth: 1,
          borderRadius: 16,
          padding: 14,
          marginBottom: 24,
          backgroundColor: '#fff',
        }}
      />

      <Button title={loading ? 'Signing in…' : 'Sign in'} onPress={handleLogin} disabled={loading} />

      <TouchableOpacity onPress={onRegister} style={{ marginTop: 16 }}>
        <Text style={{ color: '#2563eb', textAlign: 'center' }}>Don’t have an account? Register</Text>
      </TouchableOpacity>
    </View>
  );
}
