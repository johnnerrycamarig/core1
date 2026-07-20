import { ReactNode } from 'react';
import { Link, NavLink } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';

interface Props {
  children: ReactNode;
}

export default function AppLayout({ children }: Props) {
  const { user, logout } = useAuth();

  return (
    <div className="min-h-screen bg-slate-100 text-slate-900">
      <div className="flex min-h-screen">
        <aside className="hidden w-80 flex-col border-r border-slate-200 bg-slate-950 text-white lg:flex">
          <div className="flex h-20 items-center justify-center border-b border-white/10 px-6 text-lg font-semibold">IntelliTrack</div>
          <nav className="flex flex-1 flex-col gap-1 p-6 text-sm">
            <NavLink to="/dashboard" className={({ isActive }) => `rounded-3xl px-4 py-3 ${isActive ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white'}`}>
              Dashboard
            </NavLink>
            <NavLink to="/clients" className={({ isActive }) => `rounded-3xl px-4 py-3 ${isActive ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white'}`}>
              CRM
            </NavLink>
            <NavLink to="/job-orders" className={({ isActive }) => `rounded-3xl px-4 py-3 ${isActive ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white'}`}>
              Job Orders
            </NavLink>
            <NavLink to="/rental" className={({ isActive }) => `rounded-3xl px-4 py-3 ${isActive ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white'}`}>
              Rental
            </NavLink>
            <NavLink to="/projects" className={({ isActive }) => `rounded-3xl px-4 py-3 ${isActive ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white'}`}>
              Projects
            </NavLink>
            <NavLink to="/reports" className={({ isActive }) => `rounded-3xl px-4 py-3 ${isActive ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white'}`}>
              Reports
            </NavLink>
            <NavLink to="/settings" className={({ isActive }) => `rounded-3xl px-4 py-3 ${isActive ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white'}`}>
              Settings
            </NavLink>
          </nav>
        </aside>
        <div className="flex-1">
          <header className="border-b border-slate-200 bg-white shadow-sm">
            <div className="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
              <div className="flex items-center gap-4">
                <button className="lg:hidden rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-slate-700">Menu</button>
                <div className="text-xl font-semibold text-slate-900">IntelliTrack Web</div>
              </div>
              {user ? (
                <div className="flex items-center gap-3">
                  <div className="rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-sm text-slate-700">{user.name}</div>
                  <button onClick={logout} className="rounded-full bg-slate-900 px-4 py-2 text-sm text-white hover:bg-slate-700">Logout</button>
                </div>
              ) : (
                <div className="flex items-center gap-3">
                  <Link to="/login" className="rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-sm text-slate-700">Login</Link>
                  <Link to="/register" className="rounded-full bg-blue-600 px-4 py-2 text-sm text-white">Register</Link>
                </div>
              )}
            </div>
          </header>
          <main className="mx-auto max-w-7xl px-6 py-10">{children}</main>
        </div>
      </div>
    </div>
  );
}
