Open `preview.html` in the `frontend` folder for a static visual preview of the dashboard.

How to open:

- Using File Explorer: double-click `frontend\preview.html` to open in your default browser.
- Using a simple static server (recommended for correct file:// behavior):

  ```bash
  # from repo root
  # if Python is available
  cd frontend
  python -m http.server 5174
  # then open http://localhost:5174/preview.html
  ```

Notes:
- This is a static mock preview (no live API). Use the earlier instructions to run the real frontend and backend for a full interactive site.
