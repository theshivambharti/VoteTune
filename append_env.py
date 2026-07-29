import os

env_vars = """
# Socialite Providers
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"

FACEBOOK_CLIENT_ID=
FACEBOOK_CLIENT_SECRET=
FACEBOOK_REDIRECT_URI="${APP_URL}/auth/facebook/callback"

APPLE_CLIENT_ID=
APPLE_CLIENT_SECRET=
APPLE_REDIRECT_URI="${APP_URL}/auth/apple/callback"
APPLE_TEAM_ID=
APPLE_KEY_ID=
APPLE_PRIVATE_KEY=
"""

for file_name in ['.env', '.env.example']:
    path = os.path.join('C:\\xampp82\\htdocs\\VoteTune', file_name)
    if os.path.exists(path):
        with open(path, 'a', encoding='utf-8') as f:
            f.write(env_vars)

print("Appended to .env and .env.example")
