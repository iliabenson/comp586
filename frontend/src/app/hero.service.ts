import { Injectable } from '@angular/core';
import { Hero } from './hero';
import { Observable } from 'rxjs/Observable';
import { of } from 'rxjs/observable/of';
import { MessageService } from './message.service';
import { HttpClient, HttpHeaders } from '@angular/common/http';
// import { AuthHttp } from 'angular2-jwt';
import { catchError, map, tap } from 'rxjs/operators';
// import 'rxjs/add/operator/map';
// import 'rxjs/add/operator/catch';
// import 'rxjs/add/operator/do';

const httpOptions = {
  headers: new HttpHeaders({ 'Content-Type': 'application/json' })
};

@Injectable()
export class HeroService {

  // private heroesUrl = 'http://comp586.app/api/heroes';  // Todo: fix this, URL to web api
  private heroesUrl = 'http://ec2-34-215-152-141.us-west-2.compute.amazonaws.com/api/heroes';

  private handleError<T> (operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {

      // TODO: send the error to remote logging infrastructure
      console.error(error); // log to console instead

      // TODO: better job of transforming error for user consumption
      this.log(`${operation} failed: ${error.message}`);

      // Let the app keep running by returning an empty result.
      return of(result as T);
    };
  }

  /** GET heroes from the server */
  getHeroes(): Observable<Hero[]> {
    return this.http.get<Hero[]>(this.heroesUrl).pipe(
      tap(heroes => this.log(`fetched heroes, ${this.heroesUrl}`)),
      catchError(this.handleError('getHeroes', []))
    );

    // return this.authHttp.get(this.heroesUrl)
    //   .map(res => <Hero[]>res.json())
    //   .do(heroes => this.log(`fetched heroes, ${this.heroesUrl}`))
    //   .catch(this.handleError('getHeroes', []));
  }

  /** GET hero by id. Will 404 if id not found */
  getHero(id: number): Observable<Hero> {
    const url = `${this.heroesUrl}/${id}`;
    return this.http.get<Hero>(url).pipe(
      tap(_ => this.log(`fetched hero id=${id}, ${url}`)),
      catchError(this.handleError<Hero>(`getHero id=${id}`))
    );

    // return this.authHttp.get(url)
    //   .map(res => <Hero>res.json())
    //   .catch(this.handleError<Hero>(`getHero id=${id}`));
  }

  /** PUT: update the hero on the server */
  updateHero (hero: Hero): Observable<any> {
    const url = `${this.heroesUrl}/${hero.id}`;
    return this.http.put(url, hero, httpOptions).pipe(
      tap(_ => this.log(`updated hero id=${hero.id}, ${url}`)),
      catchError(this.handleError<any>('updateHero'))
    );

    // return this.authHttp.put(url, hero)
    //   .map(res => <any>res.json())
    //   .catch(this.handleError<any>('updateHero'));
  }

  /** POST: add a new hero to the server */
  addHero (hero: Hero): Observable<Hero> {
    return this.http.post<Hero>(this.heroesUrl, hero, httpOptions).pipe(
      tap((hero: Hero) => this.log(`added hero w/ id=${hero.id}, ${this.heroesUrl}`)),
      catchError(this.handleError<Hero>('addHero'))
    );

    // return this.authHttp.post(this.heroesUrl, hero)
    //   .map(res => <Hero>res.json())
    //   .catch(this.handleError<Hero>('addHero'));
  }

  /** DELETE: delete the hero from the server */
  deleteHero (hero: Hero | number): Observable<Hero> {
    const id = typeof hero === 'number' ? hero : hero.id;
    const url = `${this.heroesUrl}/${id}`;

    return this.http.delete<Hero>(url, httpOptions).pipe(
      tap(_ => this.log(`deleted hero id=${id}, ${url}`)),
      catchError(this.handleError<Hero>('deleteHero'))
    );

    // return this.authHttp.delete(url)
    //   .map(res => <Hero>res.json())
    //   .catch(this.handleError<Hero>('deleteHero'));
  }

  /* GET heroes whose name contains search term */
  searchHeroes(term: string): Observable<Hero[]> {
    if (!term.trim()) {
      // if not search term, return empty hero array.
      return of([]);
    }
    const url = `${this.heroesUrl}/search/${term}`;
    return this.http.get<Hero[]>(url).pipe(
      tap(_ => this.log(`found heroes matching "${term}", ${url}`)),
      catchError(this.handleError<Hero[]>('searchHeroes', []))
    );

    // return this.authHttp.get(url)
    //   .map(res => <Hero[]>res.json())
    //   .catch(this.handleError<Hero[]>('searchHeroes', []));
  }

  /** Log a HeroService message with the MessageService */
  private log(message: string) {
    this.messageService.add('HeroService: ' + message);
  }

  constructor(
    private http: HttpClient,
    // private authHttp: AuthHttp,
    private messageService: MessageService) { }
}
