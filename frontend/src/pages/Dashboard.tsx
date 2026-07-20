import { useEffect, useState } from 'react';
import { useAuth } from '../context/AuthContext';
import { useEffect, useState } from 'react';
import { useAuth } from '../context/AuthContext';
import { fetchDashboardMetrics, DashboardMetrics, fetchJobOrders } from '../services/api';

type JobOrder = { id: number; order_id: string; client: string; service: string; status: string };

function StatCard({ title, value, icon, color }: { title: string; value: string; icon: JSX.Element; color?: string }) {
  return (
    <div className="rounded-2xl bg-white p-5 shadow-sm flex items-center gap-4">
      <div className={`flex h-12 w-12 items-center justify-center rounded-lg text-white ${color ?? 'bg-blue-600'}`}>
        {icon}
      </div>
      <div className="flex-1">
        <div className="text-sm font-medium text-slate-500">{title}</div>
        <div className="mt-1 text-2xl font-semibold text-slate-900">{value}</div>
      </div>
    </div>
  );
}

export default function Dashboard() {
  const { user } = useAuth();
  const [metrics, setMetrics] = useState<DashboardMetrics | null>(null);
  const [jobOrders, setJobOrders] = useState<JobOrder[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    let mounted = true;
    const load = async () => {
      try {
        const data = await fetchDashboardMetrics();
        if (mounted) setMetrics(data);
        const orders = await fetchJobOrders();
        if (mounted) setJobOrders(Array.isArray(orders) ? orders : []);
      } catch (err) {
        // ignore
      } finally {
        if (mounted) setLoading(false);
      }
    };
    load();
    return () => {
      mounted = false;
    };
  }, []);

  const stats = [
    { title: 'Total Clients', value: metrics ? String(metrics.clients) : '—', color: 'bg-indigo-600', icon: (
        <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5.121 17.804A13.937 13.937 0 0112 15c2.89 0 5.56.88 7.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
      ) },
    { title: 'Active Jobs', value: metrics ? String(metrics.active_jobs) : '—', color: 'bg-emerald-600', icon: (
        <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6" />
        </svg>
      ) },
    { title: 'Rentals', value: metrics ? String(metrics.rentals) : '—', color: 'bg-yellow-500', icon: (
        <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M16 3v4M8 3v4" />
        </svg>
      ) },
    { title: 'Projects', value: metrics ? String(metrics.projects) : '—', color: 'bg-rose-600', icon: (
        <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 7h18M3 12h18M3 17h18" />
        </svg>
      ) },
  ];

  return (
    <section className="space-y-6">
      <div className="rounded-3xl bg-white p-8 shadow-sm">
        <div className="flex items-center justify-between gap-6">
          <div>
            <h1 className="text-2xl font-semibold">Welcome, {user?.name ?? 'Admin'}</h1>
            <p className="text-slate-500">Overview of your company's activity and quick actions.</p>
          </div>
          <div className="flex items-center gap-3">
            <button className="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm">Create Job</button>
            <button className="rounded-xl bg-blue-600 px-4 py-2 text-sm text-white">New Client</button>
          </div>
        </div>
      </div>

      <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        {stats.map((s) => (
          <StatCard key={s.title} title={s.title} value={loading ? 'Loading…' : s.value} icon={s.icon as JSX.Element} color={s.color} />
        ))}
      </div>

      <div className="rounded-2xl bg-white p-6 shadow-sm">
        <div className="flex items-center justify-between mb-4">
          <h2 className="text-lg font-semibold">Recent Job Orders</h2>
          <a href="/job-orders" className="text-sm text-blue-600 font-medium hover:underline">View All →</a>
        </div>
        <div className="overflow-x-auto">
          <table className="w-full text-sm text-slate-700">
            <thead className="border-b border-slate-200">
              <tr>
                <th className="text-left py-3 px-4 font-semibold">JOB ORDER ID</th>
                <th className="text-left py-3 px-4 font-semibold">CLIENT NAME</th>
                <th className="text-left py-3 px-4 font-semibold">SERVICE TYPE</th>
                <th className="text-left py-3 px-4 font-semibold">STATUS</th>
              </tr>
            </thead>
            <tbody>
              {loading ? (
                <tr>
                  <td colSpan={4} className="py-4 px-4 text-center text-slate-500">Loading…</td>
                </tr>
              ) : jobOrders.length > 0 ? (
                jobOrders.slice(0, 5).map((order) => (
                  <tr key={order.id} className="border-b border-slate-100 hover:bg-slate-50">
                    <td className="py-3 px-4 font-medium text-slate-900">{order.order_id}</td>
                    <td className="py-3 px-4">{order.client}</td>
                    <td className="py-3 px-4">{order.service}</td>
                    <td className="py-3 px-4">
                      <span className={`inline-block px-3 py-1 rounded-full text-xs font-medium ${
                        order.status === 'Completed' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800'
                      }`}>
                        {order.status}
                      </span>
                    </td>
                  </tr>
                ))
              ) : (
                <tr>
                  <td colSpan={4} className="py-4 px-4 text-center text-slate-500">No job orders yet</td>
                </tr>
              )}
            </tbody>
          </table>
        </div>
      </div>
    </section>
  );
}
