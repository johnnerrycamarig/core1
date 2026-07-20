import { useEffect, useState } from 'react';
import { fetchClients } from '../services/api';

interface Client {
  id: number;
  name: string;
  contact: string;
  email: string;
  last?: string;
}

export default function Clients() {
  const [clients, setClients] = useState<Client[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchClients()
      .then((data) => setClients(data))
      .finally(() => setLoading(false));
  }, []);

  return (
    <section className="space-y-6">
      <div className="rounded-3xl bg-white p-8 shadow-sm">
        <div className="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <h1 className="text-2xl font-semibold">Customer Relationship Management</h1>
            <p className="text-slate-500">Manage and maintain customer relationships.</p>
          </div>
          <button className="rounded-full bg-blue-600 px-4 py-2 text-white">Add Client</button>
        </div>
      </div>
      <div className="rounded-3xl bg-white p-6 shadow-sm">
        <div className="mb-4 flex items-center justify-between">
          <h2 className="text-lg font-semibold">Customer List</h2>
          <button className="rounded-full border border-slate-200 px-4 py-2 text-slate-700">Export</button>
        </div>
        {loading ? (
          <div className="py-10 text-center text-slate-500">Loading clients…</div>
        ) : (
          <table className="min-w-full divide-y divide-slate-200">
            <thead className="bg-slate-50">
              <tr>
                <th className="px-4 py-3 text-left text-sm font-semibold text-slate-600">Name</th>
                <th className="px-4 py-3 text-left text-sm font-semibold text-slate-600">Contact</th>
                <th className="px-4 py-3 text-left text-sm font-semibold text-slate-600">Email</th>
                <th className="px-4 py-3 text-left text-sm font-semibold text-slate-600">Last Transaction</th>
                <th className="px-4 py-3 text-left text-sm font-semibold text-slate-600">Action</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-slate-200 bg-white">
              {clients.map((customer) => (
                <tr key={customer.id}>
                  <td className="px-4 py-4 text-sm text-slate-700">{customer.name}</td>
                  <td className="px-4 py-4 text-sm text-slate-700">{customer.contact}</td>
                  <td className="px-4 py-4 text-sm text-slate-700">{customer.email}</td>
                  <td className="px-4 py-4 text-sm text-slate-700">{customer.last ?? 'N/A'}</td>
                  <td className="px-4 py-4 text-sm">
                    <button className="rounded-full border border-slate-200 px-3 py-1 text-slate-700">View / Edit</button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        )}
      </div>
    </section>
  );
}
