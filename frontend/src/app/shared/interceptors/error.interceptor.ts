import {HttpEvent, HttpHandler, HttpInterceptor, HttpRequest} from '@angular/common/http';
import {Injectable} from '@angular/core';
import {MatSnackBar} from '@angular/material/snack-bar';
import {catchError, Observable, throwError} from 'rxjs';

@Injectable()
export class ErrorInterceptor implements HttpInterceptor {

    constructor(private readonly snackBar: MatSnackBar) {
    }

    intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
        return next.handle(request).pipe(catchError(err => {
            const error = (err && err.error && err.error.message) || err.statusText;

            console.error(err);
            this.dataErrorSnackBar(error);

            return throwError(() => new Error(error));
        }));
    }

    dataErrorSnackBar(message: string, action: string = 'Schließen'): void {
        this.snackBar.open(`Fehler beim Laden/Übertagen der Daten: ${message}`, action, {
            horizontalPosition: 'left',
            duration: 3000,
        });
    }
}
