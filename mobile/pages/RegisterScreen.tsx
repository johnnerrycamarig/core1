import React, { useState } from 'react';
import { Alert, Button, Text, TextInput, TouchableOpacity, View } from 'react-native';
import { useAuth } from '../context/AuthContext';

interface Props {
  onSignIn: () => void;
}

export default function RegisterScreen({ onSignIn }: Props) {
  const { register } = useAuth();
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [passwordConfirmation, setPasswordConfirmation] = useState('');
  const [loading, setLoading] = useState(false);

  const handleRegister = async () => {
    setLoading(true);
    try {
      await register(name, email, password, passwordConfirmation);
    } catch (error: any) {
      Alert.alert('Registration failed', error.message || 'Unable to register');
    } finally {
      setLoading(false);
    }
  };

  return (
    <View style={{ width: '100%' }}>
      <Text style={{ fontSize: 28, fontWeight: '700', marginBottom: 12 }}>Create account</Text>
      <Text style={{ color: '#64748b', marginBottom: 24 }}>Register a new IntelliTrack account.</Text>

      <Text style={{ marginBottom: 8, color: '#334155' }}>Full name</Text>
      <TextInput
        value={name}
        onChangeText={setName}
        style={{
          borderColor: '#cbd5e1',
          borderWidth: 1,
          borderRadius: 16,
          padding: 14,
          marginBottom: 16,
          backgroundColor: '#fff',
        }}
      />

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
          marginBottom: 16,
          backgroundColor: '#fff',
        }}
      />

      <Text style={{ marginBottom: 8, color: '#334155' }}>Confirm password</Text>
      <TextInput
        value={passwordConfirmation}
        onChangeText={setPasswordConfirmation}
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

      <Button title={loading ? 'Creating account…' : 'Create account'} onPress={handleRegister} disabled={loading} />

      <TouchableOpacity onPress={onSignIn} style={{ marginTop: 16 }}>
        <Text style={{ color: '#2563eb', textAlign: 'center' }}>Already have an account? Sign in</Text>
      </TouchableOpacity>
    </View>
  );
}
