import subprocess
import os
git_path = '.git'
os.environ['PATH'] += os.pathsep + git_path

# print()
# subprocess.call(['ls'])
cek_pull = input('ingin melakukan pull request? (y jika iya) ')
if(cek_pull == 'y'):
    os.system('ls')
    print(subprocess.call(['git', 'pull', '.']))

cek_migrate = input('ingin melakukan migrate ? (y jika iya) ')
if(cek_migrate == 'y'):
    print(subprocess.call(['php', 'artisan', 'migrate:fresh', '--seed']))

input("Press Enter to exit...")
