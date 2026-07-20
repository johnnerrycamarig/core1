export default function Settings() {
  return (
    <section className="space-y-6">
      <div className="rounded-3xl bg-white p-8 shadow-sm">
        <h1 className="text-2xl font-semibold">Settings</h1>
        <p className="text-slate-500">Manage account settings, security, and preferences.</p>
      </div>
      <div className="rounded-3xl bg-white p-8 shadow-sm">
        <div className="space-y-6">
          <div className="grid gap-6 lg:grid-cols-2">
            <div className="rounded-3xl border border-slate-200 bg-slate-50 p-5">
              <div className="text-sm font-semibold text-slate-600">Profile</div>
              <div className="mt-2 text-slate-700">Update your profile, email, and contact details.</div>
            </div>
            <div className="rounded-3xl border border-slate-200 bg-slate-50 p-5">
              <div className="text-sm font-semibold text-slate-600">Security</div>
              <div className="mt-2 text-slate-700">Enable MFA, password reset, and login alerts.</div>
            </div>
          </div>
          <div className="rounded-3xl border border-slate-200 bg-slate-50 p-5">
            <div className="text-sm font-semibold text-slate-600">Notifications</div>
            <div className="mt-2 text-slate-700">Manage system and email notification preferences.</div>
          </div>
        </div>
      </div>
    </section>
  );
}
