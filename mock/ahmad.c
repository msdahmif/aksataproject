typedef struct {
	pthread_mutex_t *mut;
	int writers;
	int readers;
	int waiting;
	pthread_cond_t *writeOK, *readOK;
} rwl;

rwl *initlock (void)
{
	rwl *lock;
	lock = (rwl *)malloc (sizeof (rwl));
	if (lock == NULL) return (NULL);
	lock->mut = (pthread_mutex_t *) malloc (sizeof (pthread_mutex_t));
	if (lock->mut == NULL) {
		free (lock);
		return (NULL);
	}
	lock->writeOK =
		(pthread_cond_t *) malloc (sizeof (pthread_cond_t));
	if (lock->writeOK == NULL) {
		free (lock->mut);
		free (lock);
		return (NULL);
	}
	lock->readOK =
		(pthread_cond_t *) malloc (sizeof (pthread_cond_t));
	if (lock->writeOK == NULL) {
		free (lock->mut);
		free (lock->writeOK);
		free (lock);
		return (NULL);
	}
	pthread_mutex_init (lock->mut, NULL);
	pthread_cond_init (lock->writeOK, NULL);
	pthread_cond_init (lock->readOK, NULL);
	lock->readers = 0;
	lock->writers = 0;
	lock->waiting = 0;
	return (lock);
}

void readlock (rwl *lock, int d)
{
	pthread_mutex_lock (lock->mut);
	if (lock->writers || lock->waiting) {
		do {
			printf ("reader %d blocked.\n", d);
			pthread_cond_wait (lock->readOK, lock->mut);
			printf ("reader %d unblocked.\n", d);
		} while (lock->writers);
	}
	lock->readers++;
	pthread_mutex_unlock (lock->mut);
	return;
}

void writelock (rwl *lock, int d)
{
	pthread_mutex_lock (lock->mut);
	lock->waiting++;
	while (lock->readers || lock->writers) {
		printf ("writer %d blocked.\n", d);
		pthread_cond_wait (lock->writeOK, lock->mut);
		printf ("writer %d unblocked.\n", d);
	}
	lock->waiting--;
	lock->writers++;
	pthread_mutex_unlock (lock->mut);
	return;
}

void readunlock (rwl *lock)
{
	pthread_mutex_lock (lock->mut);
	lock->readers--;
	pthread_cond_signal (lock->writeOK);
	pthread_mutex_unlock (lock->mut);
}

void writeunlock (rwl *lock)
{
	pthread_mutex_lock (lock->mut);
	lock->writers--;
	pthread_cond_broadcast (lock->readOK);
	pthread_mutex_unlock (lock->mut);
}

void deletelock (rwl *lock)
{
	pthread_mutex_destroy (lock->mut);
	pthread_cond_destroy (lock->readOK);
	pthread_cond_destroy (lock->writeOK);
	free (lock);
	return;
}
