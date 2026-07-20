import React, { useEffect, useState } from 'react';
import { Button, FlatList, Text, View } from 'react-native';
import { fetchClients } from '../services/api';
import { useAuth } from '../context/AuthContext';

export default function DashboardScreen() {
  const { user, token, logout } = useAuth();
  const [clients, setClients] = useState<Array<{ id: number; name: string; email: string }>>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    if (!token) return;
    fetchClients(token)
      .then((data) => setClients(data))
      .finally(() => setLoading(false));
  }, [token]);

  return (
    <View style={{ width: '100%' }}>
      <View style={{ marginBottom: 24, gap: 8 }}>
        <Text style={{ fontSize: 24, fontWeight: '700' }}>Hello, {user?.name ?? 'Admin'}</Text>
        <Text style={{ color: '#64748b' }}>Your mobile dashboard is connected to IntelliTrack API.</Text>
      </View>

      <View style={{ marginBottom: 20 }}>
        <Button title="Logout" onPress={logout} />
      </View>

      <Text style={{ marginBottom: 12, fontSize: 18, fontWeight: '600' }}>Clients</Text>
      {loading ? (
        <Text style={{ color: '#64748b' }}>Loading clients…</Text>
      ) : (
        <FlatList
          data={clients}
          keyExtractor={(item) => item.id.toString()}
          renderItem={({ item }) => (
            <View style={{ backgroundColor: '#fff', borderRadius: 16, padding: 16, marginBottom: 12, shadowColor: '#000', shadowOpacity: 0.05, shadowRadius: 12, elevation: 2 }}>
              <Text style={{ fontSize: 16, fontWeight: '600' }}>{item.name}</Text>
              <Text style={{ color: '#475569' }}>{item.email}</Text>
            </View>
          )}
        />
      )}
    </View>
  );
}
